import React, { useEffect, useState } from 'react';
import ApiService from '../services/ApiService';

function AdminDashboard() {
  const [posts, setPosts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    ApiService.get('/posts')
      .then(response => {
        setPosts(response.data);
        setLoading(false);
      })
      .catch(err => {
        setError('Failed to load posts');
        setLoading(false);
      });
  }, []);

  if (loading) return <p>Loading...</p>;
  if (error) return <p>{error}</p>;

  return (
    <div>
      <h1>Admin Dashboard</h1>
      <ul>
        {posts.length === 0 ? (
          <li>No posts found.</li>
        ) : (
          posts.map(post => <li key={post.id}>{post.title}</li>)
        )}
      </ul>
    </div>
  );
}

export default AdminDashboard;
