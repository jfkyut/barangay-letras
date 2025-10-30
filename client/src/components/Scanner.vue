<script setup>
import Dynamsoft from "dwt";
import { onMounted, onUnmounted, ref } from "vue";
import { useToast } from 'vue-toastification';
import { Button, InputText } from "primevue";

const { uploadUrl } = defineProps({
    uploadUrl: String,
    isShowUploadButton: {
        type: Boolean,
        default: true
    }
})

const fileName = ref('document');

const cookies = ref(null);

const emit = defineEmits(['emptyResponse', 'response']);

let selectedIndex = ref(0);
let sourceList=ref([]);
let DWObject;
const containerId = "dwtcontrolContainer";

const toast = useToast()

// Function to parse document.cookie into key-value pairs
const parseCookies = () => {
  const cookieString = document.cookie;
  const cookieArr = cookieString.split('; ');
  const cookieObj = {};
  cookieArr.forEach(cookie => {
    const [key, value] = cookie.split('=');
    cookieObj[key] = decodeURIComponent(value); // Decode URI encoded values
  });
  return cookieObj;
};

// Function to get a specific cookie by name
const getCookie = (name) => {
  const cookies = parseCookies();
  return cookies[name];
};

onMounted(() => {
  /**
   * ResourcesPath & ProductKey must be set in order to use the library!
   */
  Dynamsoft.DWT.AutoLoad = false;
  Dynamsoft.DWT.ResourcesPath = "/dwt-resources";
  Dynamsoft.DWT.ProductKey = import.meta.env.VITE_TWAIN_KEY;
  Dynamsoft.DWT.Containers = [
    {
      WebTwainId: "dwtObject",
      ContainerId: containerId,
      Width: "600px",
      Height: "690px",
    },
  ];
  Dynamsoft.DWT.RegisterEvent("OnWebTwainReady", () => {
    Dynamsoft_OnReady();
  });
  Dynamsoft.DWT.Load();

  cookies.value = parseCookies();
});

onUnmounted(()=>{
    Dynamsoft.DWT.Unload();
})
function Dynamsoft_OnReady() {
  DWObject = Dynamsoft.DWT.GetWebTwain(containerId);
  DWObject.GetDevicesAsync()
    .then((deviceList) => {
      sourceList.value = deviceList;
    })
    .catch((e) => {
      console.error(e);
    });
}
/**
 * Acquire images from scanners
 */
function acquireImage() {
    DWObject.SelectDeviceAsync(sourceList.value[selectedIndex.value])
      .then(() => {
        return DWObject.AcquireImageAsync({IfCloseSourceAfterAcquire:true});
      })
      .catch((e) => {
        console.error(e);
      })
}

/**
 * Open local images.
 */
function openImage() {
  DWObject.IfShowFileDialog = true;
  /**
   * Note:
   * This following line of code uses the PDF Rasterizer which is an extra add-on that is licensed seperately
   */
  DWObject.Addon.PDF.SetConvertMode(Dynamsoft.DWT.EnumDWT_ConvertMode.CM_RENDERALL);
  DWObject.LoadImageEx(
    "",
    Dynamsoft.DWT.EnumDWT_ImageType.IT_ALL,
    () => {
        // success
    },
    () => {
      //failure
    }
  );
}

const upload = () => {

    if (DWObject && DWObject.HowManyImagesInBuffer > 0) {

        // DWObject.SetHTTPHeader('Authorization', sessionStorage.getItem('auth.token'));

        DWObject.SetHTTPHeader('X-XSRF-TOKEN', getCookie('XSRF-TOKEN'))
        DWObject.HTTPUploadAllThroughPostAsPDF(
            `${import.meta.env.VITE_SHARED_IP}`,
            uploadUrl,
            fileName.value,
            () => {
                emit('emptyResponse')
            },
            (errorCode, errorString, response) => {
                emit('response', { errorCode, errorString, response })
            }
        );
    } else {
        alert("There is no image in buffer.");
    }
}

const saveAsPDF = () => {
    DWObject.SaveAsPDF('wuteva', 0, () => {}, () => {})
}
</script>

<template>
  <div class="max-w-4xl mx-auto">
    <div class="flex gap-4 justify-center">
        <div class="w-full space-y-2">
            <label for="">Scanner Driver</label>
            <select v-model="selectedIndex" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:ring-4 focus:outline-none focus:border-blue-500 block w-full py-3.5 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                <option
                    v-for="(source, index) in sourceList"
                    :value="index"
                    :key="index"
                >
                    {{ source.displayName }}
                </option>
            </select>
        </div>
        <div class="w-full space-y-2">
            <label for="">File Name</label>
            <InputText v-model="fileName" placeholder="Enter file name" />
        </div>
    </div>
    <div class="flex justify-center mt-4">
        <div class="flex gap-2 w-full">
            <div class="flex gap-2 w-full">
                <Button @click="acquireImage()">
                    <i class="ri-qr-scan-line"></i>
                    Start Scan
                </Button>
                <Button severity="secondary" v-if="$page.props.auth.user.role.role === 'developer'" @click="openImage()">
                    <i class="ri-folder-5-line"></i>
                    Browse Image
                </Button>
            </div>
            <div class="flex gap-2 w-full justify-end" v-if="isShowUploadButton">
                <Button @click="upload">
                    <i class="ri-upload-line"></i>
                    Upload images
                </Button>
                <!-- <PrimaryButton @click="saveAsPDF">
                    <i class="ri-save-line"></i>
                    Save as PDF
                </PrimaryButton> -->
            </div>
        </div>
    </div>
    <div class="my-4">
        <div :id="containerId" class="w-fit mx-auto"></div>
    </div>
</div>
</template>

<style scoped></style>
