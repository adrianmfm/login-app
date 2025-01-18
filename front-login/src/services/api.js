import axios from "axios";

const apiClient = axios.create({
    baseURL: 'http://login.test/api',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
});

apiClient.interceptors.request.use((config) => {
    const token = localStorage.getItem('token');

    if(token){
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});

export default apiClient;