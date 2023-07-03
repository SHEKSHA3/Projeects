import React, { useState } from "react";

const Task2 = () => {
    const [pre,setPre]=useState('100')

    const handleChages=(e)=>{
        setPre(75+parseInt(pre));
    }

  return (
    <div>
     <p>${pre}</p>
     <button onClick={handleChages}>Apply Discount</button>
    </div>
  );
};

export default Task2;
