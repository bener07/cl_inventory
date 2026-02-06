import TablePage from './table_maker.js';

let placesPage = new TablePage('users', [
				{ data: 'id', name: 'id', title: 'Id'},
			  	{ data: 'name', name: 'Name', title: 'User Name'},
			  	{ data: 'email', name: 'Email', title: 'Email'},
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