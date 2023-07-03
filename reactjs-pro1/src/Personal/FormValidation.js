import React, { useState, useEffect } from "react";

const FormValidation = () => {
  const [windowwith, setwindowwith] = useState(window.innerWidth);

  const handleResize=()=>{
    setwindowwith(window.innerWidth);
  }
  useEffect(() => {
    window.addEventListener("resize", handleResize);
  }, []);

  return (
    <div>
     
      <h2>{windowwith}</h2>
    </div>
  );
};

export default FormValidation;
