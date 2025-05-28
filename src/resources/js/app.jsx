import React from 'react';
import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';

import LoginPage from './pages/LoginPage';
import DashboardPage from './pages/DashboardPage';
import AuthService from './core/services/AuthService';

// Component bảo vệ route yêu cầu login
function ProtectedRoute({ children }) {
  if (!AuthService.getToken()) {
    // Nếu chưa đăng nhập thì chuyển hướng về trang login
    return <Navigate to="/admin/login" replace />;
  }
  // Nếu đã đăng nhập thì render component con bình thường
  return children;
}

// Component logout, khi mount sẽ gọi logout rồi chuyển về login
function Logout() {
  React.useEffect(() => {
    AuthService.logout();
    window.location.href = '/admin/login';
  }, []);

  return null;
}

export default function App() {
  return (
    <BrowserRouter>
      <Routes>
        {/* Route cho trang login */}
        <Route path="/admin/login" element={<LoginPage />} />

        {/* Route dashboard yêu cầu phải đăng nhập */}
        <Route
          path="/admin/dashboard"
          element={
            <ProtectedRoute>
              <DashboardPage />
            </ProtectedRoute>
          }
        />

        {/* Route logout */}
        <Route path="/admin/logout" element={<Logout />} />

        {/* Route mặc định (fallback) */}
        <Route path="*" element={<Navigate to="/admin/login" replace />} />
      </Routes>
    </BrowserRouter>
  );
}
