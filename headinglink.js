/* Setup smooth scrolling for .headinglink */
document.querySelectorAll("a.smooth").forEach(anchor => {
  anchor.addEventListener("click", function(e) {
	e.preventDefault()

	document.querySelector(this.getAttribute("href")).scrollIntoView({
	  behavior: "smooth",
	  block: "start" //scroll to top of the target element
	})
  })
})