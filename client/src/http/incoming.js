import { useApiUtilities } from "@/utilities/api";
import axios from "axios";

const { sendApiRequest } = useApiUtilities();

export const useHttpIncoming = () => {

    const getIncomingsRequest = (params) => {
        return sendApiRequest( async () => {
            return await axios.get('/api/incoming-communications', { params });
        });
    }

    const createIncomingRequest = (form) => {
        return sendApiRequest( async () => {
            return await axios.post('/api/incoming-communications', form, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Accept': 'application/json',
                }
            });
        })
    }

    const updateIncomingRequest = (incoming_id, form) => {
        form.append('_method', 'PUT');

        return sendApiRequest( async () => {
            return await axios.post(`/api/incoming-communications/${incoming_id}/update`, form, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Accept': 'application/json',
                }
            });
        })
    }

    const deleteIncomingRequest = (incoming_id) => {
        return sendApiRequest( async () => {
            return await axios.delete(`/api/incoming-communications/${incoming_id}/destroy`);
        })
    }

    return {
        getIncomingsRequest,
        createIncomingRequest,
        updateIncomingRequest,
        deleteIncomingRequest,
    }
}