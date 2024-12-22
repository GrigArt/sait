function getResults() {
	//здесь будет отправка запроса на сервер
}
function createBlocks(results) {
	const mainBlock = document.getElementsByTagName("main")[0];
	const d = document.createElement('div');
	d.textContent = JSON.stringify(res);
	mainBlock.appendChild(d);
	for (let i = 0; i < results.length; i++) {
		const block = document.createElement('div');
		block.className = 'block';
		const a = document.createElement('a');
		a.setAttribute('href', results[i].a_href);
		a.textContent = results[i].a_text;
		const hr = document.createElement('hr');
		const div = document.createElement('div');
		div.className = 'meta';
		div.textContent = results[i].meta;
		block.appendChild(a);
		block.appendChild(hr);
		block.appendChild(div);
		mainBlock.appendChild(block);
		
		
	}
}
let params = new URLSearchParams(document.location.search);
let res = $("#result").load("php/getPerson.php");
alert(res);
console.log(res);
let values = params.get("search");
let searchResult = {
	a_href: "result.html",
	a_text: "result",
	meta: "text"
}
let resultArray = [searchResult, searchResult, searchResult];
createBlocks(resultArray);


