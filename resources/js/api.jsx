import Swal from 'sweetalert2';
export default class API
{
	static send(url, method='GET', data='', success= (data)=>{}, error=()=>{}){
		let csrfToken = $('meta[name="csrf-token"]').attr('content');
		console.log(csrfToken);
		return $.ajax({
			url: url,
			method: method,
			data: data,
			headers: {
				'X-CSRF-TOKEN': csrfToken,
			},
			xhrFields:{
				withCredentials: true
			},
			contentType: data instanceof FormData ? false : 'application/json; charset=utf-8',
			processData: !(data instanceof FormData),
			success: function(data){
//				resolve(data);
				success(data);
			},
			error: function (e){
				console.error("Something went wrong on the request: ", e);
				//reject(e);
			}
		})
	}

	static prettySender(url, method='GET', data=''){
		API.send(url, method, data,
				(data) => {
					Swal.fire({
							title: "Success",
							text: "Guardado com sucesso",
							icon: 'success'
						});
				(data) => {
					Swal.fire({
						title: "Error",
						text: data.message,
						icon: 'error',
					});
				}
			});
	}
}