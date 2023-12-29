import React from 'react';
export default function Button ({buttonColor, children }) {
    return <button className={`btn ${buttonColor}`}>
        {children }
    </button>;
}
