const sections = document.querySelectorAll(".section")
const chapters = document.querySelectorAll(".chapter-title")
const copyButtons = document.querySelectorAll(".copy-button")

let selected = document.querySelector(".selected")
window.addEventListener("scroll", () => {
	sections.forEach(section => {
		const rect = section.getBoundingClientRect()

		if (rect.top <= 0.5 && rect.top >= -rect.height) {
			selected.classList.remove("selected")

			let sectionNumber = section.id.slice(7)
			selected = chapters[sectionNumber - 1]

			selected.classList.add("selected")
		}
	});
})

copyButtons.forEach(button => {
	button.addEventListener("click", () => {
		let text = button.parentElement.querySelector(".text").innerText
		let icon = button.querySelector("span")

		navigator.clipboard.writeText(text)

		icon.innerText = "check_circle"
		setTimeout(() => {
			icon.innerText = "content_copy"
		}, 1000);
	})
});