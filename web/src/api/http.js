import axios from 'axios';
import { ConfigEnvironments } from '@/env/config_environments';
import Vue from 'vue';

const client = axios.create({
  baseURL: ConfigEnvironments.getUrl(),
  timeout: 30000
});

client.interceptors.request.use(config => {
  return config;
}, error => {
  return Promise.reject(error);
});

client.interceptors.response.use((response) => {
  return response;
}, (error) => {
  
  const errorResponse = error && error.response ? error.response : null;
  const responseData = errorResponse ? errorResponse.data : null;
  const errorResult = responseData ? responseData : error;
  const status = errorResponse ? errorResponse.status : null;
  const errorMessage = responseData ? responseData.error : null;
  const errorType = typeof errorMessage;
  const stringErrorType = errorType == 'string';

  if (stringErrorType)
    Vue.$toast.error(`${errorMessage}`, {
      timeout: 2000,
    });

  return Promise.reject(errorResult);
});

export default client; 