import React, { useState } from 'react';
import AuthService from '../../core/services/AuthService';

export default function LoginForm() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await AuthService.login(email, password);
      window.location.href = '/admin/dashboard';
    } catch (error) {
      console.error(error);
      alert('Login failed');
    }
  };

  return (
    <form onSubmit={handleSubmit}>
      <input
        type="email"              
        placeholder="Email"
        value={email}
        onChange={(e) => setEmail(e.target.value)}
        required                  
      />
      <input
        type="password"
        placeholder="Password"
        value={password}
        onChange={(e) => setPassword(e.target.value)}
        required
      />
      <button type="submit">Login</button>
    </form>
  );
}
