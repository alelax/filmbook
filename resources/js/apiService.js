import axios from 'axios';
const API_URL = 'http://localhost:8000';
const TMDB_URL = 'https://api.themoviedb.org/3/';
const TMDB_API_KEY = 'eb256750e09137c9565156e96a6e8ce1'

export class APIService{

  constructor(){}

  getPopulars(page = 1) {
    const url = `${TMDB_URL}movie/popular?api_key=${TMDB_API_KEY}&language=it-It&page=${page}`;
    return axios.get(url).then(response => response.data);
  }

}