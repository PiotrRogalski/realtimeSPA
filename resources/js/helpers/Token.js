class Token {

    isValid(token) {
        const payload = this.payload(token);
        let validIss = [
            'http://127.0.0.1:8000/api/auth/login',
            'http://127.0.0.1:8000/api/auth/signup'
        ];
        let len = validIss.length;

        if(payload) {
            for(let i = 0; i < len; ++i) {
                if(payload.iss == validIss[i]) {
                    return true;
                }
            }
        }
        return false;
    }

    payload(token) {
        const payload = token.split('.')[1];
        return this.decode(payload);
    }

    decode(payload) {
        return JSON.parse(atob(payload));
    }
}

export default Token = new Token();