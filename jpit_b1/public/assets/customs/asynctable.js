// Asynchronous Delete

class AsyncTable
{
	constructor(table, csrf, url)
	{
		this.table = table;
		this.csrf = csrf;
		this._url = url;
	}
	set targetRow(row) {
		this._row = row;
		this._rowid = this.extractRowID(row);
	}
	get targetRow() {
		return this._row;
	}
	set rowID(rowid) {
		this._rowid = rowid;
	}
	get rowID() {
		return this._rowid;
	}
	extractRowID = row => {
		let row_id_str = row.attr('id');
		let str = row_id_str.split('-');
		return str[1];
	}
	set url(url) {
		this._url = url;
	}
	get url() {
		return this._url;
	}
	deleteRow = () => {
		let header = this.csrf;
		$.ajax({
			'url': this._url + "/" + this._rowid,
			'type': 'DELETE',
			'dataType': 'json',
			'beforeSend': function (xhr){ xhr.setRequestHeader('X-CSRF-TOKEN', header); },
			'success': function (result){
				deleteDTRow();
			}
		});
		let deleteDTRow = () => {
			this.table.row(this._row).remove().draw(false);
		};  
	}
	updateRow = (form) => {
		let header = this.csrf;
		$.ajax({		
			'url': this._url + "/" + this._rowid,
			'type': 'PUT',
			'dataType': 'json',
			'data': form.serialize(),
			'beforeSend': function (xhr){ xhr.setRequestHeader('X-CSRF-TOKEN', header); },
			'success': function (result){
				updateDTRow(result);
			}
		});
		let updateDTRow = (data) => {
			let temp = this.table.row(this._row).data();
			let newData = Object.keys(data).map(function (key){
				return data[key];
			});
			temp[1] = newData[1];
			temp[2] = newData[2];
			this.table.row(this._row).data(temp).draw(false);
		}
	}
	editRow = (callback) => {
		let header = this.csrf;
		$.ajax({		
			'url': this._url + '/' + this._rowid + '/edit',
			'type': 'GET',
			'dataType': 'json',
			'beforeSend': function (xhr){ xhr.setRequestHeader('X-CSRF-TOKEN', header); },
			'success': function (result){
				callback(result);
			}
		});

	}
	
}
