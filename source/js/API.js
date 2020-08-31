class WPAjax {
    constructor (method='/', data={}) {

        // Create request body
        const body = Object.assign({
            'action': 'mirele_endpoint_v1',
            'method': method
        }, data);

        // Create form
        let form = new FormData;

        for (const [key, value] of Object.entries(body)) {
            form.append(key, value || false);
        }

        return axios.post(MIRELE.urls.ajax, form);
    }
}