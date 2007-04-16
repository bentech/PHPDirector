<!--
	function show_hide(tblid, show) {
		if (tbl = document.getElementById(tblid)) {
			if (null == show) show = tbl.style.display == 'none';
			tbl.style.display = (show ? '' : 'none');
		}
	}

function viewMore(div) {
	obj = document.getElementById(div);
	col = document.getElementById("x" + div);
	
	if (obj.style.display == "none") {
		obj.style.display = "block";
		col.innerHTML = "... less";
	} else {
		obj.style.display = "none";
		col.innerHTML = "... more";
	}
	}
//!-->