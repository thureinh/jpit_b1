// Asynchronous Delete

class AsyncTable
{
	row_id = -1;
	constructor(table, csrf)
	{
		this.table = table;
		this.csrf = csrf;
	}
	set row(row) {
		this._row = row;
	}
	get row() {
		return this._row;
	}
	targetRow = row_id => {
		let str = row_id;
		this.row_id = str.split('-')[1];
	}
	set deleteURL(url) {
		this._delete_url = url;
	}
	get deleteURL() {
		return this._delete_url;
	}
	delete = () => {
		let header = this.csrf;
		$.ajax({
			'url': this._delete_url + "/" + this.row_id,
			'type': 'DELETE',
			'dataType': 'json',
			'beforeSend': function (xhr){ xhr.setRequestHeader('X-CSRF-TOKEN', header); },
			'success': function (result){
				deleteRow();
			}
		});
		let deleteRow = () => {
			this.table.row(this._row).remove().draw();
		};  
	}
	
}
