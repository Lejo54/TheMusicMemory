import React from "react";
import ReactDOM from "react-dom";
export default function MyFirstComponent() {
  return (<h1>This is my first React Component!</h1>);
}
if (document.getElementById("MyFirstComponent")) {
  ReactDOM.render(<Hello React />, document.getElementById("MyFirstComponent"));
}