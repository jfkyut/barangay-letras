import axios from "axios";
import { useApiUtilities } from "@/utilities/api";

const { getCsrfToken, sendApiRequest } = useApiUtilities();

export const useHttpSession = () => {

  const getSessionsRequest = (params) => {
    return sendApiRequest( async () => {
      return await axios.get('/api/sessions', { params });
    });
  }

  const createSessionRequest = (form) => {
    return sendApiRequest( async () => {
        await axios.post('/api/sessions', form);

        return true;
    });
  } 

  const updateSessionRequest = (session_id, form) => {
    return sendApiRequest( async () => {
      await axios.put(`/api/session/${session_id}`, form);

      return true;
    })
  }

  const deleteSessionRequest = (session_id) => {
    return sendApiRequest( async () => {
      await axios.delete(`/api/session/${session_id}`);

      return true;
    })
  }

  const getSessionTypesRequest = () => {
    return sendApiRequest( async () => {
      const { data } = await axios.get('/api/session-types');

      return data;
    });
  }

  return {
    getSessionsRequest,
    createSessionRequest,
    updateSessionRequest,
    deleteSessionRequest,

    getSessionTypesRequest,
  }
}