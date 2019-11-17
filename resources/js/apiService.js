import axios from 'axios';
const API_URL = 'http://localhost:8000/api/v1/';
const TMDB_URL = 'https://api.themoviedb.org/3/';
const TMDB_API_KEY = 'eb256750e09137c9565156e96a6e8ce1'

export class APIService{

  constructor(){}

  getPopulars(page = 1) {
    const url = `${TMDB_URL}movie/popular?api_key=${TMDB_API_KEY}&language=it-It&page=${page}`;
    return axios.get(url).then(response => response.data);
  }

  addToMyList(data) {
    const body = {
      "title": data.title,
      "posterPath": data.poster_path,
      "toWatch": true,
      "watched": false,
      "externalId": data.externalId
    }
    console.log('body addToMyList', body)
    const url = `${API_URL}action/store`;
    return axios.post(url, body).then(response => response.data);
  }

  addToMyWatchedList(data) {
    const body = {
      "title": data.title,
      "posterPath": data.poster_path,
      "toWatch": false,
      "watched": true,
      "externalId": data.externalId
    }
    console.log('body addToMyWatchedList', body)
    const url = `${API_URL}action/store-watched`;
    return axios.post(url, body).then(response => response.data);
  }
  
  
  getMyList() {
    const url = `${API_URL}action/my-list`;
    return axios.get(url).then(response => response.data);
  }

  getMyWatchedList() {
    const url = `${API_URL}action/my-watched-list`;
    return axios.get(url).then(response => response.data);
  }


}