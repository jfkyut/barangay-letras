import axios from "axios";
import { useApiUtilities } from "@/utilities/api";

const { getCsrfToken, sendApiRequest } = useApiUtilities();

export const useHttpCouncil = () => {

  const getCouncilsRequest = (params) => {
    return sendApiRequest( async () => {
        const { data } = await axios.get('/api/councils', { params });

        return data;
    });
  }

  return {
    getCouncilsRequest,
  }
}