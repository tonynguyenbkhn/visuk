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

        items.forEach(function(item) {
            const textEl = item.querySelector('.elementor-icon-list-text');
            
            if (textEl && textEl.textContent.trim() === 'Sign in') {
                textEl.textContent = 'My account';      // đổi text
                item.setAttribute('href', '/my-account/'); // đổi link
            }
        });
    }
})
