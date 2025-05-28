import ApiService from './ApiService';

export default class AuthService {
  static async login(email, password) {
    const res = await ApiService.post('/login', { email, password });
    localStorage.setItem('token', res.data.token); // Sửa ở đây
    return res.data.user; // Sửa ở đây
  }

  static logout() {
    localStorage.removeItem('token');
  }

  static getToken() {
    return localStorage.getItem('token');
  }
}
