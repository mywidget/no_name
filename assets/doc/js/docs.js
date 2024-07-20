"use strict";


/* ====== Define JS Constants ====== */
const sidebarToggler = document.getElementById('docs-sidebar-toggler');
const sidebar = document.getElementById('docs-sidebar');
const sidebarLinks = document.querySelectorAll('#docs-sidebar .scrollto');



/* ===== Responsive Sidebar ====== */

window.onload=function() 
{ 
    responsiveSidebar(); 
};

window.onresize=function() 
{ 
    responsiveSidebar(); 
};


function responsiveSidebar() {
    let w = window.innerWidth;
	if(w >= 1200) {
	    // if larger 
	    console.log('larger');
		sidebar.classList.remove('sidebar-hidden');
		sidebar.classList.add('sidebar-visible');
		
		} else {
	    // if smaller
	    console.log('smaller');
	    sidebar.classList.remove('sidebar-visible');
		sidebar.classList.add('sidebar-hidden');
	}
};

sidebarToggler.addEventListener('click', () => {
	if (sidebar.classList.contains('sidebar-visible')) {
		console.log('visible');
		sidebar.classList.remove('sidebar-visible');
		sidebar.classList.add('sidebar-hidden');
		
		} else {
		console.log('hidden');
		sidebar.classList.remove('sidebar-hidden');
		sidebar.classList.add('sidebar-visible');
	}
});


/* ===== Smooth scrolling ====== */
/*  Note: You need to include smoothscroll.min.js (smooth scroll behavior polyfill) on the page to cover some browsers */
/* Ref: https://github.com/iamdustan/smoothscroll */

sidebarLinks.forEach((sidebarLink) => {
	
	sidebarLink.addEventListener('click', (e) => {
		
		e.preventDefault();
		
		var target = sidebarLink.getAttribute("href").replace('#', '');
		
		//console.log(target);
		
        document.getElementById(target).scrollIntoView({ behavior: 'smooth' });
        
        
        //Collapse sidebar after clicking
		if (sidebar.classList.contains('sidebar-visible') && window.innerWidth < 1200){
			
			sidebar.classList.remove('sidebar-visible');
		    sidebar.classList.add('sidebar-hidden');
		} 
		
	});
	
});

/* ===== Gumshoe SrollSpy ===== */
/* Ref: https://github.com/cferdinandi/gumshoe  */
// Initialize Gumshoe
var spy = new Gumshoe('#docs-nav a', {
	offset: 69 //sticky header height
});
/* ====== GLightbox Plugin ======= */
var lightboxDescription = GLightbox({
	selector: '.lightbox',
	loop: true,
});

var lightboxDescription = GLightbox({
	selector: '.xampp',
	loop: true,
	autoplayVideos: false
});
var lightboxDescription = GLightbox({
	selector: '.extract',
	loop: true,
	autoplayVideos: false
});
var lightboxDescription = GLightbox({
	selector: '.phpmyadmin',
	loop: true,
	autoplayVideos: false
});
var lightboxDescription = GLightbox({
	selector: '.install',
	loop: true,
	autoplayVideos: false
});
var lightboxDescription = GLightbox({
	selector: '.transaksi',
	loop: true,
	autoplayVideos: false
});
var lightboxDescription = GLightbox({
	selector: '.pengguna',
	loop: true,
	autoplayVideos: false
});
var lightboxDescription = GLightbox({
	selector: '.pembayaran',
	loop: true,
	autoplayVideos: false
});
var lightboxDescription = GLightbox({
	selector: '.rekening',
	loop: true,
	autoplayVideos: false
});

var lightboxDescription = GLightbox({
	selector: '.kategori',
	loop: true,
	autoplayVideos: false
});
var lightboxDescription = GLightbox({
	selector: '.printer',
	loop: true,
	autoplayVideos: false
});

var lightboxDescription = GLightbox({
	selector: '.menu-admin',
	loop: true,
	autoplayVideos: false
});
var lightboxDescription = GLightbox({
	selector: '.bahan',
	loop: true,
});
var lightboxDescription = GLightbox({
	selector: '.satuan',
	loop: true,
});
var lightboxDescription = GLightbox({
	selector: '.produk',
	loop: true,
});
var lightboxDescription = GLightbox({
	selector: '.supplier',
	loop: true,
});
var lightboxDescription = GLightbox({
	selector: '.pengeluaran',
	loop: true,
});
var lightboxDescription = GLightbox({
	selector: '.mutasi',
	loop: true,
});
var lightboxDescription = GLightbox({
	selector: '.penjualan',
	loop: true,
});
var lightboxDescription = GLightbox({
	selector: '.uangmasuk',
	loop: true,
});
var lightboxDescription = GLightbox({
	selector: '.pendapatan',
	loop: true,
});
var lightboxDescription = GLightbox({
	selector: '.log',
	loop: true,
});
var lightboxDescription = GLightbox({
	selector: '.profil',
	loop: true,
});
var lightboxDescription = GLightbox({
	selector: '.update',
	loop: true,
});
var lightboxDescription = GLightbox({
	selector: '.backup',
	loop: true,
});
var lightboxDescription = GLightbox({
	selector: '.grafik',
	loop: true,
});
var lightboxDescription = GLightbox({
	selector: '.pelanggan',
	loop: true,
});
 
var width = screen.width;
// console.log(width)
/* ====== Pencarian ======= */
$('#searchtxt').keyup(function(){
	var text = $(this).val();
	text = text.toLowerCase().replace(/\b[a-z]/g, function(letter) {
		return letter.toUpperCase();
	});
	$('body').removeHighlight();
	if ( text ) {
		$('.docs-article').hide();
		$('.docs-article .docs-section:contains("'+text+'")').closest('.docs-article').show();
		$('body').highlight( text );
		}else{
		$('.docs-article').show();
	}
});

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	return new bootstrap.Tooltip(tooltipTriggerEl)
});var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
	return new bootstrap.Popover(popoverTriggerEl)
});



