import TablePage from './table_maker.js';

let placesPage = new TablePage('places', [
				{ data: 'id', name: 'id', title: 'Id'},
			  	{ data: 'number', name: 'Port Number', title: 'Port Number'},
			  	//{ data: 'quantity', name: 'Quantity', title: 'Quantity'},
				{
					data: null,
					title: 'Ações',
					orderable: false,
					render: function (data, type, row){
				  		return `<button class="edit-btn" data-id="${row.id}" data-item="${JSON.stringify(row)}">Edit</button>
									<button class="delete-btn" data-id="${data.id}">Delete</button>`;
					}
				 }
		 	]
			 );

placesPage.setup();