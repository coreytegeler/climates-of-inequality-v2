const html = document.querySelector("html"),
			body = document.querySelector("body");

/*****************************
************FILTERS***********
*****************************/

const loop = document.querySelector("#loop"),
			filterSelects = document.querySelectorAll(".select-dropdown select"),
			filterNotice = document.querySelector("#filter-notice"),
			filterList = document.querySelector("#filter-list"),
			filterReset = document.querySelector("#filter-reset");

const onFilterUpdate = (e) => {
	const params = {},
				select = e.target,
				selected = select.options[select.selectedIndex],
				label = select.previousElementSibling,
				value = select.value,
				labelText = value ? selected.text : label.dataset.default;

	filterSelects.forEach((select) => {
		if(select.value) {
			params[select.id] = select.value;
		}
	});
	

	label.innerText = labelText;
	// const newURL = settings.current + paramify(params);
	getLoop(params);
	updateFilterList();
}

const onFilterReset = (e) => {
	filterSelects.forEach((select) => {
		const label = select.previousElementSibling,
					labelText = label.dataset.default;
		label.innerText = labelText;
		select.value = '';
	});
	getLoop();
	updateFilterList();
}

const updateFilterList = () => {
	filterList.innerHTML = "";
	filterSelects.forEach((select) => {
		const selected = select.options[select.selectedIndex];
		if(selected.value) {
			filterList.innerHTML += `<span class="mr-sm">${selected.text}</span>`;
		}
	});

	filterNotice.setAttribute("aria-hidden", !filterList.innerHTML);
}

const getLoop = (params = {}) => {
	params.type = loop.dataset.postType;
	const xhttp = new XMLHttpRequest(),
				reqURL = settings.api + "get_loop" + paramify(params);
	
	console.log(reqURL);
	xhttp.onreadystatechange = () => {
		if (xhttp.readyState === 4 && xhttp.status === 200) {
			loop.innerHTML = xhttp.responseText;
			loop.classList.remove("loading");
		}
	};

	xhttp.open("GET", reqURL, true);
	xhttp.send();
	loop.classList.add("loading");
}

const paramify = (obj) => {
	return "?" + Object.keys(obj).map((key) => {
		return key+"="+encodeURIComponent(obj[key])
	}).join("&");
}

filterSelects.forEach((filterSelect) => {
	filterSelect.addEventListener("change", onFilterUpdate);
});

if(filterReset) {
	filterReset.addEventListener("click", onFilterReset);
}


/*****************************
***********SLIDESHOW**********
*****************************/

const slideshow =  document.querySelector("#slideshow");

const slideshowSetup = (e) => {
	const arrows = slideshow.querySelectorAll(".slideshow-arrow");
	arrows.forEach((arrow) => {
		arrow.addEventListener("click", moveSlideshow)
	});
}

const moveSlideshow = (e) => {
	const arrow = e.target,
				direction = arrow.dataset.direction,
				mediaSlides = slideshow.querySelectorAll(".slide.media"),
				captionSlides = slideshow.querySelectorAll(".slide.caption"),
				slidesLength = parseInt(slideshow.dataset.length),
				currentIndex = parseInt(slideshow.dataset.active);
	
	let newIndex;

	if(direction === "next") {
		newIndex = currentIndex + 1;
		if(currentIndex >= slidesLength - 1) {
			newIndex = 0;
		}
	}

	if(direction === "prev") {
		newIndex = currentIndex - 1;
		if(newIndex < 0) {
			newIndex = slidesLength - 1;
		}
	}

	slideshow.dataset.active = newIndex;

	mediaSlides[currentIndex].classList.remove("active");
	captionSlides[currentIndex].classList.remove("active");

	mediaSlides[newIndex].classList.add("active");
	captionSlides[newIndex].classList.add("active");

}


if(slideshow) {
	slideshow.addEventListener("click", slideshowSetup);
}



