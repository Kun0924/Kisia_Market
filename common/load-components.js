// 헤더와 푸터를 로드하는 함수
function loadComponents() {
    // 현재 페이지의 경로를 기반으로 상대 경로 계산
    const currentPath = window.location.pathname;
    const isMainPage = currentPath.includes('index.html');
    const basePath = isMainPage ? '' : '../';

    // 이미 로드된 헤더와 푸터가 있는지 확인
    if (!document.querySelector('header')) {
        // 헤더 로드
        fetch(basePath + 'mainmenu/common/header.html')
            .then(response => response.text())
            .then(data => {
                document.querySelector('body').insertAdjacentHTML('afterbegin', data);
                // 현재 페이지에 맞는 메뉴 활성화
                const currentPage = currentPath.split('/').pop();
                const menuItems = document.querySelectorAll('.menu-list a');
                menuItems.forEach(item => {
                    if (item.getAttribute('href') === currentPage) {
                        item.classList.add('active');
                    } else {
                        item.classList.remove('active');
                    }
                });
            });
    }

    // 이미 로드된 푸터가 있는지 확인
    if (!document.querySelector('footer')) {
        // 푸터 로드
        fetch(basePath + 'mainmenu/common/footer.html')
            .then(response => response.text())
            .then(data => {
                document.querySelector('body').insertAdjacentHTML('beforeend', data);
            });
    }
}

// 페이지 로드 시 컴포넌트 로드
document.addEventListener('DOMContentLoaded', loadComponents); 