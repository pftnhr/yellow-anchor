/* Headinglink extension, https://github.com/pftnhr/yellow-headinglink */

/* Setup smooth scrolling for .headinglink */
document.querySelectorAll("a.headinglink").forEach(anchor => {
  anchor.addEventListener("click", function(e) {
	e.preventDefault()

	document.querySelector(this.getAttribute("href")).scrollIntoView({
	  behavior: "smooth",
	  block: "start" //scroll to top of the target element
	})
  })
})