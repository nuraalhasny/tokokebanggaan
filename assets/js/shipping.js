const prov_url = `/shipping/province.php`;
const city_url = `/shipping/city.php`;
const cost_url = `/shipping/cost.php`;

document.addEventListener('DOMContentLoaded', async function() {
    const prov = await GetApi(prov_url);
    const prov_el = qSelect('#prov_id');

    const city_el = qSelect('#city_id');
    const address_el = qSelect('#address');

    const courier_el = qSelect('#courier');

    if (prov_el) {
        let html = '';
        prov.rajaongkir.results.forEach(item => {
            html += `<option value="${item.province_id}">${item.province}</option>`
        });
        
        prov_el.innerHTML = html;
        

    }

    if (city_el) {
        qSelect('#prov_id').addEventListener('change', async function (e) {
            const prov_id = prov_el.value;
            const city = await GetApi(city_url+`?prov_id=${prov_id}`);
            let html = '';
            
            city.rajaongkir.results.forEach(item => {
                html += `<option value="${item.city_id}">${item.city_name}</option>`
            });
            
            city_el.innerHTML = html;

            qSelect('#city_id').addEventListener('change', function (e) {
                checkButtonEnabled();
            });
            checkButtonEnabled();
        });
    }

    if (address_el) {
        qSelect('#address').addEventListener('change', function (e) {
            checkButtonEnabled();
        });
    }
    
    if (courier_el) {
        qSelect('#courier').addEventListener('change', function (e) {
            checkButtonEnabled();
        });
    }
    
    const checkButtonEnabled = async () => {
        const prov_id = qSelect('#prov_id').value;
        const city_id = qSelect('#city_id').value;
        const address = qSelect('#address').value;
        const courier = qSelect('#courier').value;
        const service = qSelect('#service').value;

        if (prov_id && city_id && courier) {
            const cost = await GetApi(cost_url+`?city_id=${city_id}&courier=${courier}`);
            let html = '';
            console.log(cost);
            cost.rajaongkir.results[0].costs.forEach(item => {
                html += `<option value="${item.service} - ${item.cost[0].value} (${item.cost[0].etd} Hari)">
                    ${item.service} - ${item.cost[0].value} (${item.cost[0].etd} Hari)
                </option>`;
            })

            qSelect('#service').innerHTML = html;
        }

        if (prov_id && city_id && address && courier && service) {
            const submit = qSelect('#submit');
            submit.disabled = false;
            submit.parentElement.disabled = false;
        }
    }
});