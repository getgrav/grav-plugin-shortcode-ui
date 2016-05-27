document.addEventListener( "DOMContentLoaded", function() {
	var collapses = document.querySelectorAll('[data-toggle="collapse"]');
	var item;

	[].forEach.call(collapses, function(collapse) {
		collapse.onclick = function(){
	        this.classList.toggle('active');
	        item = this.nextElementSibling;

	        if (this.classList.contains('active')) {
	        	item.style.maxHeight = item.dataset.maxHeight + 'px';
	        } else {
	        	item.style.maxHeight = 0;
	        }
	    }

	    item = collapse.nextElementSibling;
		item.dataset.maxHeight = item.offsetHeight;
		item.style.maxHeight   = 0;
	});
});
