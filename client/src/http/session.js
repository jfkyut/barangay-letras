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
        return await axios.post('/api/sessions', form, {
          headers: {
            'Content-Type': 'multipart/form-data',
            'Accept': 'application/json',
          }
        });
    });
  } 

  const updateSessionRequest = (session_id, form) => {
    
    form.append('_method', 'PUT');

    return sendApiRequest( async () => {
      return await axios.post(`/api/session/${session_id}/update`, form, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'Accept': 'application/json',
        }
      });
    })
  }

  const deleteSessionRequest = (session_id) => {
    return sendApiRequest( async () => {
      return await axios.delete(`/api/session/${session_id}/destroy`);
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