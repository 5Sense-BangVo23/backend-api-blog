import axios from 'axios';

class ApiService {
  constructor() {
    this.api = axios.create({
      baseURL: 'http://localhost:8555/api', // Địa chỉ backend Laravel API
      headers: {
        'Content-Type': 'application/json',
      },
      withCredentials: true, // Nếu backend dùng cookie/session
    });
  }

  // Ví dụ GET request
  get(resource, params = {}) {
    return this.api.get(resource, { params });
  }

  // Ví dụ POST request
  post(resource, data) {
    return this.api.post(resource, data);
  }

  // Ví dụ PUT request
  put(resource, data) {
    return this.api.put(resource, data);
  }

  // Ví dụ DELETE request
  delete(resource) {
    return this.api.delete(resource);
  }

}

export default new ApiService();
