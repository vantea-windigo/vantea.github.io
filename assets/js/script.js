let addWindow = document.getElementById('addWindow');
let overlay = document.getElementById('TB_overlay');

function addWindowShow(state, opac, z) {
	addWindow.style.display = state;
	overlay.style.zIndex = z;
	overlay.style.opacity = opac;
}

function itemExists() {
	swal({
		title: 'Внимание!',
		text: 'Такой файл уже существует.',
		icon: "warning"
	});
}

function uncorrectUrl() {
	swal({
		title: 'Ошибка!',
		text: 'Введен не корректный адрес.',
		icon: "error"
	});
}

function error() {
	swal({
		title: 'Ошибка!',
		text: 'Неизвестная ошибка.',
		icon: "error"
	});
}

function itemDelete(link) {
	var request = new XMLHttpRequest();
	request.open("GET", "http://git-cloud.by/index.php?result="+link);
}