// const axios = require("axios");
const fetch = require("node-fetch");
const url = "https://xkcd.com/info.0.json";
//se puede usar axios o fetch como hice despues

// axios
//   .get(url)
//   .then((res) => console.log(res.data))
//   .catch((err) => console.log(err));

//con promesas
// const getData = (url) => {
//   fetch(url)
//     .then((response) => response.json())
//     .then((response) => {
//       let data = response;
//       console.log(data.img);
//     })
//     .catch((error) => {
//       console.log(error);
//     });
// };

//aqui con una funcion asincrona
const getData = async (url) => {
  try {
    const result = await fetch(url);
    const data = await result.json();
    return console.log(data.img);
  } catch (error) {
    console.log(error);
  }
};

getData(url);
