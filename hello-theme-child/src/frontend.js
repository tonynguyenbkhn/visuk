import './bootstrap/bootstrap.scss'
import './scss/frontend.scss'
import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'

import init from 'lib/init-blocks'

document.addEventListener('DOMContentLoaded', () => {
    init({
        block: 'blocks'
    }).mount();

    // Kiểm tra user đã đăng nhập chưa
    if (document.body.classList.contains("logged-in")) {

        // Tìm tất cả item trong icon list
        const items = document.querySelectorAll('.elementor-icon-list-item a');

        items.forEach(function (item) {
            const textEl = item.querySelector('.elementor-icon-list-text');

            if (textEl && textEl.textContent.trim() === 'Sign in') {
                textEl.textContent = 'My account';      // đổi text
                item.setAttribute('href', '/my-account/'); // đổi link
            }
        });
    }

    function updateActiveBox() {
        const boxes = document.querySelectorAll('.iump-form-paybox');
        boxes.forEach(b => b.classList.remove('active'));

        const selectedImg = document.querySelector('.ihc-payment-select-img-selected');
        if (selectedImg) {
            const box = selectedImg.closest('.iump-form-paybox');
            if (box) box.classList.add('active');
        }
    }

    // chạy 1 lần khi trang load
    updateActiveBox();

    // Observer lên toàn bộ BODY (KHÔNG BAO GIỜ bị replace)
    const observer = new MutationObserver(mutations => {
        let changed = false;

        mutations.forEach(m => {
            // Khi có new HTML sau AJAX
            if (m.type === 'childList' && (m.addedNodes.length || m.removedNodes.length)) {
                changed = true;
            }
            // Hoặc khi plugin đổi class selected
            if (m.type === 'attributes' && m.attributeName === 'class') {
                changed = true;
            }
        });

        if (changed) {
            // đợi DOM update xong
            requestAnimationFrame(updateActiveBox);
        }
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true,
        attributes: true,
        attributeFilter: ['class']
    });

})
