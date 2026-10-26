(() => {
	'use strict';

	const header = document.querySelector('[data-tmm-header]');
	const search = document.querySelector('[data-tmm-search]');

	/* La barre prend une ombre dès qu'on fait défiler la page */
	if (header) {
		const onScroll = () => header.classList.toggle('is-scrolled', window.scrollY > 8);
		onScroll();
		window.addEventListener('scroll', onScroll, { passive: true });
	}

	document.addEventListener('keydown', (event) => {
		if (!search) return;

		const target = event.target;
		const isTyping = target instanceof HTMLElement && (
			target.isContentEditable || /^(INPUT|TEXTAREA|SELECT)$/.test(target.tagName)
		);
		const wantsSearch =
			(event.key === '/' && !isTyping) ||
			((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === 'k');

		if (wantsSearch) {
			event.preventDefault();
			search.focus();
			search.select();
		} else if (event.key === 'Escape' && document.activeElement === search) {
			search.blur();
		}
	});

	/* Confirmation avant une action sensible : <a data-confirm="Message"> */
	document.addEventListener('click', (event) => {
		const el = event.target instanceof Element ? event.target.closest('[data-confirm]') : null;
		if (el && !window.confirm(el.dataset.confirm)) {
			event.preventDefault();
		}
	});
})();