export default {
    
    methods: {
        logoutAction() {
            axios.post('/api/logout', {}, { headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } })
                .then(res => {
                    localStorage.setItem('token', '');
                    this.$router.push('/login')
                })
                .catch(e => {
                    return e;
                })
        }
    }
}