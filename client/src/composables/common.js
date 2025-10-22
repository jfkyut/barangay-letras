import { ref } from 'vue';
import { useToast } from 'vue-toastification';

const toast = useToast();


export const useCommon = () => {

    const isCopied = ref(false);

    const copyText = async (text) => {
        try {
            if (navigator.clipboard && navigator.clipboard.writeText) {
                await navigator.clipboard.writeText(text);
                console.log("Text copied to clipboard using Clipboard API!");
            } else {
                // Fallback for insecure contexts
                const tempInput = document.createElement("input");
                tempInput.value = text;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand("copy");
                document.body.removeChild(tempInput);
                console.log("Text copied using fallback!");
            }

            toast.success('Copied successfully')

        } catch (err) {
            console.error("Failed to copy text: ", err);
        }
    }

    const years = [];

    const date = new Date();

    const currentYear = date.getFullYear();

    for (let year = 1970; year <= currentYear; year++) {
        years.unshift(year);
    }

    const tableHeaderClass = 'text-xs bg-zinc-200 text-zinc-700 uppercase dark:bg-zinc-700 dark:text-zinc-400 gold:bg-gold-300 teal:bg-teal-200';

    const barangays = [
        'Alimanguan',
        'Binga',
        'Caruray',
        'Kemdeng',
        'New Agutaya',
        'New Canipo',
        'Poblacion',
        'Port Barton',
        'San Isidro',
        'Sto. Niño',
    ]

    const redirectToNewTab = (url) => window.open(url, '_blank');

    const handleCouncilChange = async (council_id) => {
        const { data } = await axios.get(route('council.data', council_id));

        return {
            committees: data.committees,
            councilMembers: data.councilMembers
        }
    }

    const convertToOrdinal = (num) => {
        if (!num) return "N/A";

        const strNum = String(num);

        // handle special cases: 11, 12, 13
        const lastTwo = strNum.slice(-2);
        if (lastTwo === "11" || lastTwo === "12" || lastTwo === "13") {
            return `${num}th Council`;
        }

        // check last digit
        const lastDigit = strNum.slice(-1);
        let suffix = "th";
        if (lastDigit === "1") suffix = "st";
        else if (lastDigit === "2") suffix = "nd";
        else if (lastDigit === "3") suffix = "rd";

        return `${num}${suffix}`;
    }

    return { 
        copyText, 
        isCopied, 
        years, 
        tableHeaderClass, 
        barangays, 
        redirectToNewTab,
        handleCouncilChange,
        convertToOrdinal
    }
}
