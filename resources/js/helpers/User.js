import Token from './Token'
import AppStorage from './AppStorage'

class User {
    login(form) {
        axios.post('/api/auth/login', form)
            .then(res => this.responseAfterLogin(res))
            .catch(error => console.log(error.response.data))
    }

    responseAfterLogin(res) {
        const access_token =  res.data.access_token;
        const username =  res.data.user;

        if(Token.isValid(access_token)) {
            AppStorage.store(username, access_token );
        }
        window.location = '/forum'
    }
    
    hasToken() {
         const storedToken = AppStorage.getToken();

         if(storedToken) {
            return (Token.isValid(storedToken)) ? true : false;
         }

         return false;
    }

    isLogged() {
         return this.hasToken();
    }

    logout() {
         AppStorage.clear();
         window.location = '/forum';
         return true;
    }

    name() {
         return (this.isLogged()) ? AppStorage.getUser() : false;
    }

    id() {
        if(this.isLogged()) {
            const payload = Token.payload(AppStorage.getToken());
            return payload.sub;
        }

        return false;
    }

    //checking if the id is equal to logged user
    own(id) {
       return this.id() === id;
    }

}

export default User = new User();