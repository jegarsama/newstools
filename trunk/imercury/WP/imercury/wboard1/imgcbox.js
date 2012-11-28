/**
 * Created by 행복한고니
 *
 * Homepage    : http://mygony.com
 * Last update : 2005/02/22
 *
 * 2004-09-23 
 *     - 첫번째 릴리즈
 * 2005-02-22
 *     - checked 로 설정했을경우 첫번째 클릭에 반응하지 않던 오류수정 (연히 님)
 *     - undefined 체크 구문 수정 (빌 님)
 */

function imgCbox(N, tabstop)
{
	var objs, cboxes, Img, Span, A;

	if (typeof N == 'undefined') return false;
	if (typeof tabstop == 'undefined') tabstop = true;
	if ((objs=document.getElementsByName(N)) == null) return false;

	for (var i=0; i < objs.length; i++) {
		if (objs[i].tagName.toLowerCase() != "input" || objs[i].type.toLowerCase() != "checkbox") continue;
		
		if (typeof imgCbox.Objs[N] == 'undefined') {
			imgCbox.Objs[N] = new Array;
			imgCbox.ImgObjs[N] = new Array;
		}
		
		var len = imgCbox.Objs[N].length;
		imgCbox.Objs[N][len] = objs[i];
		imgCbox.ImgObjs[N][len] = {};

		// anchor element for tab stop
		A = document.createElement("A");
		if (tabstop) {
			A.href = "javascript:;";
		}
		A.onclick =  new Function("imgCbox.onclick('"+N+"',"+len+")");
		A.style.borderWidth = "0px";
		A.style.cursor = "pointer";

		// for image cache
		Img = document.createElement("IMG");
		Img.src = objs[i].getAttribute("onsrc");
		Img.style.borderWidth = "0px";
		Img.style.display = objs[i].checked?"":"none";
		imgCbox.ImgObjs[N][len]["on"] = Img;
		A.appendChild(Img);

		Img = document.createElement("IMG");
		Img.src = objs[i].getAttribute("offsrc");
		Img.style.borderWidth = "0px";
		Img.style.display = objs[i].checked?"none":"";
		imgCbox.ImgObjs[N][len]["off"] = Img;
		A.appendChild(Img);

		// insert object
		Span = objs[i].parentNode;
		Span.style.display = "none";
		Span.parentNode.insertBefore(A, Span);

	}
}
imgCbox.onclick = function(N, idx) {
	var C = imgCbox.Objs[N][idx];
	var I = imgCbox.ImgObjs[N][idx];

	C.checked = !C.checked;
	if (C.checked) {
		I["on"].style.display = "";
		I["off"].style.display = "none";
	} else {
		I["on"].style.display = "none";
		I["off"].style.display = "";
	}
	
	// fire event
	if (typeof C.onclick != 'undefined' && C.onclick != null) C.onclick();
}
imgCbox.Objs = {};
imgCbox.ImgObjs = {};