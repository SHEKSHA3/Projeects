import React, { useState } from 'react';
import "./Task1.css"
const Task1 = () => {
    const [formData, setFormData] = useState({
        name: '',
        email: '',
        password: '',
        
      });
    //   console.log({formData});
    
      const handleChange = (event) => {
        setFormData({
          ...formData,
          [event.target.name]: event.target.value,
        });
      };
    
      const handleSubmit = (event) => {
        event.preventDefault();
        console.log(formData);
        // Send form data to server or perform further actions
      };
    
      return (
        <div>
          <h1>Registration Form</h1>
          <form onSubmit={handleSubmit}>
            <label>
              Name:
              <input
                type="text"
                name="name"
                value={formData.name}
                onChange={handleChange}
              />
            </label>
            <br />
            <label>
              Email:
              <input
                type="email"
                name="email"
                value={formData.email}
                onChange={handleChange}
              />
            </label>
            <br />
            <label>
              Password:
              <input
                type="password"
                name="password"
                value={formData.password}
                onChange={handleChange}
              />
            </label>        
            <br />
            <button type="submit">Submit</button>
          </form>
        </div>
      );
};

export default Task1;
