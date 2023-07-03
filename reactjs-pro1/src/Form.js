import React, { useState } from "react";
import "./Form.css";

const countries = ["USA", "Canada", "UK", "Australia"];
const genderOptions = ["Male", "Female", "Other"];
const hobbiesOptions = ["Reading", "Sports", "Music", "Travel"];

const Form = () => {
  const [formData, setFormData] = useState({
    name: "",
    lastName: "",
    country: "",
    gender: "",
    hobbies: [],
    file: null,
    date: "",
    agreeTerms: false,
  });

  const [errors, setErrors] = useState({});

  const handleChange = (e) => {
    const { name, value, type, checked } = e.target;

    
    const fieldValue = type === "checkbox" ? checked : value;
    // console.log(fieldValue)
    setFormData((prevFormData) => ({
      ...prevFormData,
      [name]: fieldValue,
    }));
  };

  const handleHobbiesChange = (e) => {
    const { value, checked } = e.target;
  
    if (checked) {
      setFormData((prevFormData) => ({
        ...prevFormData,
        hobbies: [...prevFormData.hobbies, value],
      }));
     
    } else {
      setFormData((prevFormData) => ({
        ...prevFormData,
        hobbies: prevFormData.hobbies.filter((hobby) => hobby !== value),
      }));
    }
  };

  const handleFileChange = (e) => {
    const file = e.target.files[0];
    console.log(file['name'])
    setFormData((prevFormData) => ({
      ...prevFormData,
      file: file,
    }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    if (validateForm()) {
      // Perform form submission or further processing here
      console.log("Form submitted successfully!");
      console.log(formData);
    }
  };

  const validateForm = () => {
    let formIsValid = true;
    const errors = {};

    if (!formData.name) {
      formIsValid = false;
      errors.name = "Name is required";
    }

    if (!formData.lastName) {
      formIsValid = false;
      errors.lastName = "Last name is required";
    }

    if (!formData.country) {
      formIsValid = false;
      errors.country = "Country is required";
    }

    if (!formData.gender) {
      formIsValid = false;
      errors.gender = "Gender is required";
    }

    if (formData.hobbies.length === 0) {
      formIsValid = false;
      errors.hobbies = "At least one hobby must be selected";
    }

    if (!formData.file) {
      formIsValid = false;
      errors.file = "Please upload a file";
    }

    if (!formData.date) {
      formIsValid = false;
      errors.date = "Date is required";
    }

    if (!formData.agreeTerms) {
      formIsValid = false;
      errors.agreeTerms = "Please accept the terms and conditions";
    }

    setErrors(errors);
    return formIsValid;
  };

  return (
    <div className="form-container">
      <form onSubmit={handleSubmit}>
        <div>
          <label htmlFor="name">Name:</label>
          <input
            type="text"
            id="name"
            name="name"
            value={formData.name}
            onChange={handleChange}
          />
          {errors.name && <span className="error-message">{errors.name}</span>}
        </div>

        <div>
          <label htmlFor="lastName">Last Name:</label>
          <input
            type="text"
            id="lastName"
            name="lastName"
            value={formData.lastName}
            onChange={handleChange}
          />
          {errors.lastName && (
            <span className="error-message">{errors.lastName}</span>
          )}
        </div>

        <div>
          <label htmlFor="country">Country:</label>
          <select
            id="country"
            name="country"
            value={formData.country}
            onChange={handleChange}
          >
            <option value="">Select a country</option>
            {countries.map((country) => (
              <option key={country} value={country}>
                {country}
              </option>
            ))}
          </select>
          {errors.country && <span>{errors.country}</span>}
        </div>

        <div>
          <p>Gender:</p>
          {genderOptions.map((option) => (
            <label key={option}>
              <input
                type="radio"
                name="gender"
                value={option}
                checked={formData.gender === option}
                onChange={handleChange}
              />
              {option}
            </label>
          ))}
          {errors.gender && <span>{errors.gender}</span>}
        </div>

        <div>
          <p>Hobbies:</p>
          {hobbiesOptions.map((option) => (
            <label key={option}>
              <input
                type="checkbox"
                name="hobbies"
                value={option}
                checked={formData.hobbies.includes(option)}
                onChange={handleHobbiesChange}
              />
              {option}
            </label>
          ))}
          {errors.hobbies && <span>{errors.hobbies}</span>}
        </div>

        <div>
          <label htmlFor="file">File Upload:</label>
          <input
            type="file"
            id="file"
            name="file"
            onChange={handleFileChange}
          />
          {errors.file && <span>{errors.file}</span>}
        </div>

        <div>
          <label htmlFor="date">Date:</label>
          <input
            type="date"
            id="date"
            name="date"
            value={formData.date}
            onChange={handleChange}
          />
          {errors.date && <span>{errors.date}</span>}
        </div>

        <div>
          <label htmlFor="agreeTerms">
            <input
              type="checkbox"
              id="agreeTerms"
              name="agreeTerms"
              checked={formData.agreeTerms}
              onChange={handleChange}
            />
            Agree to terms and conditions
          </label>
          {errors.agreeTerms && <span>{errors.agreeTerms}</span>}
        </div>

        <button type="submit">Submit</button>
      </form>
      <div className="form-data">
        <span>name:{formData.name}</span>
        <br />
        <span>country:{formData.country}</span>
        <br />
        <span>lastName:{formData.lastName}</span>
        <br />
        <span>gender:{formData.gender}</span>
        <br />
        <span>hobbies:{formData.hobbies}</span>
        <br />
        <span>date:{formData.date}</span>
        <br />
      </div>
    </div>
  );
};

export default Form;
