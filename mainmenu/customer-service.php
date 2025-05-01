<?php include '/var/www/html/mainmenu/queries/get_header_session.php'; ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>고객센터 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/customer-service.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>
    <?php require_once 'queries/get_notice.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="list-container">
            <div class="category-tabs">
                <button class="tab-btn active" onclick="showCategory('notice')">공지사항</button>
                <button class="tab-btn" onclick="showCategory('qna')">문의사항</button>
            </div>
            <div class="notice-section" id="noticeSection">
                <div class="notice-header">
                    <div class="notice-title">공지사항</div>
                    <div class="notice-search">
                        <input type="text" placeholder="공지사항 검색">
                        <button><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="notice-list">
                    <div class="list-header">
                        <span class="header-title">제목</span>
                        <span class="header-meta">번호</span>
                        <span class="header-user">작성자</span>
                        <span class="header-date">작성일</span>
                    </div>

                    <?php if (mysqli_num_rows($get_notice) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($get_notice)): ?>
                            <div class="qna-item notice-item">
                                <div class="qna-info">
                                    <a href="#" class="qna-title">[공지] <?= htmlspecialchars($row['title']) ?></a>
                                    <span class="qna-meta"><?= $row['id'] ?></span>
                                    <span class="qna-user">관리자</span>
                                    <span class="qna-date"><?= date('Y-m-d', strtotime($row['created_at'])) ?></span>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p style="padding: 10px;">등록된 공지사항이 없습니다.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="qna-section" id="qnaSection" style="display: none;">
                <div class="qna-header">
                    <div class="qna-title">문의사항</div>
                    <div class="qna-search">
                        <input type="text" placeholder="문의사항 검색">
                        <button><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="qna-list">
                    <div class="list-header">
                        <span class="header-title">제목</span>
                        <span class="header-meta">번호</span>
                        <span class="header-user">작성자</span>
                        <span class="header-date">작성일</span>
                    </div>
                    <div class="qna-item">
                        <div class="qna-info">
                            <a href="#" class="qna-title">q&amp;a test 2</a>
                            <span class="qna-meta">1000056</span>
                            <span class="qna-user">홍길동</span>
                            <span class="qna-date">2020-08-31</span>
                        </div>
                    </div>
                    <div class="qna-item">
                        <div class="qna-info">
                            <a href="#" class="qna-title">q&amp;a test 2</a>
                            <span class="qna-meta">1000055</span>
                            <span class="qna-user">김철수</span>
                            <span class="qna-date">2020-08-31</span>
                        </div>
                    </div>
                    <div class="qna-item">
                        <div class="qna-info">
                            <a href="#" class="qna-title">q&amp;a test</a>
                            <span class="qna-meta">1000054</span>
                            <span class="qna-user">이영희</span>
                            <span class="qna-date">2020-08-31</span>
                        </div>
                    </div>
                    <div class="qna-item">
                        <div class="qna-info">
                            <a href="#" class="qna-title">q&amp;a test</a>
                            <span class="qna-meta">1000053</span>
                            <span class="qna-user">박지성</span>
                            <span class="qna-date">2020-08-31</span>
                        </div>
                    </div>
                    <div class="qna-item">
                        <div class="qna-info">
                            <a href="#" class="qna-title">q&amp;a test</a>
                            <span class="qna-meta">1000052</span>
                            <span class="qna-user">최민수</span>
                            <span class="qna-date">2020-08-29</span>
                        </div>
                    </div>
                </div>
                <div class="write-btn-container">
                    <button class="write-btn" onclick="window.location.href='inquiry-write.php'">글쓰기</button>
                </div>
            </div>
            <div class="write-form" id="writeForm">
                <div class="form-group">
                    <label for="title">제목</label>
                    <input type="text" id="title" placeholder="제목을 입력하세요">
                </div>
                <div class="form-group">
                    <label for="content">내용</label>
                    <textarea id="content" placeholder="내용을 입력하세요"></textarea>
                </div>
                <div class="form-group">
                    <label>파일 첨부</label>
                    <input type="file" id="fileInput" class="file-upload" multiple>
                    <div class="file-list" id="fileList"></div>
                </div>
                <div class="form-group">
                    <div class="secret-option">
                        <input type="checkbox" id="isSecret">
                        <label for="isSecret">비밀글</label>
                    </div>
                </div>
                <div class="form-actions">
                    <button class="btn-cancel" onclick="toggleWriteForm()">취소</button>
                    <button class="btn-submit" onclick="submitPost()">등록</button>
                </div>
            </div>
            <div class="post-detail" id="postDetail">
                <div class="post-detail-header">
                    <div>
                        <h3 class="post-detail-title" id="detailTitle"></h3>
                        <div class="post-detail-meta" id="detailMeta"></div>
                    </div>
                </div>
                <div class="post-detail-content" id="detailContent"></div>
                <div class="post-actions">
                    <button class="btn-edit" onclick="editPost()">수정</button>
                    <button class="btn-delete" onclick="deletePost()">삭제</button>
                </div>
            </div>
            <div class="pagination">
                <?php
                for ($i = 1; $i <= $total_pages; $i++) {
                    $active = $i == $page ? 'active' : '';
                    echo "<a href='?page=$i' class='$active'>$i</a>";
                }
                if ($page < $total_pages) {
                    $next_page = $page + 1;
                    echo "<a href='?page=$next_page' class='next'>다음 <i class='fas fa-chevron-right'></i></a>";
                }
                ?>
            </div>
        </div>
    </main>

    <script>
        let currentPage = 1;
        const postsPerPage = 10;
        let allPosts = [];
        let currentPostId = null;
        let selectedFiles = [];

        function toggleWriteForm() {
            const form = document.getElementById('writeForm');
            form.classList.toggle('active');
            document.getElementById('postDetail').classList.remove('active');
        }

        // 파일 선택 처리
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const files = e.target.files;
            const fileList = document.getElementById('fileList');
            fileList.innerHTML = '';

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileItem = document.createElement('div');
                fileItem.className = 'file-item';
                fileItem.innerHTML = `
                    <span class="file-name">${file.name}</span>
                    <span class="file-remove" onclick="removeFile(${i})">×</span>
                `;
                fileList.appendChild(fileItem);
            }

            selectedFiles = Array.from(files);
        });

        // 파일 제거
        function removeFile(index) {
            selectedFiles.splice(index, 1);
            const fileList = document.getElementById('fileList');
            fileList.innerHTML = '';

            selectedFiles.forEach((file, i) => {
                const fileItem = document.createElement('div');
                fileItem.className = 'file-item';
                fileItem.innerHTML = `
                    <span class="file-name">${file.name}</span>
                    <span class="file-remove" onclick="removeFile(${i})">×</span>
                `;
                fileList.appendChild(fileItem);
            });
        }

        function submitPost() {
            const title = document.getElementById('title').value;
            const content = document.getElementById('content').value;
            const isSecret = document.getElementById('isSecret').checked;
            
            if (!title || !content) {
                alert('제목과 내용을 모두 입력해주세요.');
                return;
            }

            // 현재 날짜 생성
            const now = new Date();
            const date = now.toISOString().split('T')[0];
            
            // 새 게시글 생성
            const newPost = {
                id: Date.now(),
                title: title,
                content: content,
                number: Math.floor(Math.random() * 1000000),
                author: '사용자',
                date: date,
                isSecret: isSecret,
                files: selectedFiles.map(file => ({
                    name: file.name,
                    size: file.size,
                    type: file.type
                }))
            };

            // 게시글 배열에 추가
            allPosts.unshift(newPost);
            
            // 현재 페이지의 게시글 표시
            showPosts();

            // 폼 초기화 및 숨기기
            document.getElementById('title').value = '';
            document.getElementById('content').value = '';
            document.getElementById('isSecret').checked = false;
            document.getElementById('fileInput').value = '';
            document.getElementById('fileList').innerHTML = '';
            selectedFiles = [];
            toggleWriteForm();
        }

        function showPosts() {
            const qnaList = document.querySelector('.qna-list');
            const startIndex = (currentPage - 1) * postsPerPage;
            const endIndex = startIndex + postsPerPage;
            const postsToShow = allPosts.slice(startIndex, endIndex);

            // 헤더 다음의 모든 게시글 제거
            const header = qnaList.querySelector('.list-header');
            while (qnaList.children.length > 1) {
                qnaList.removeChild(qnaList.lastChild);
            }

            // 현재 페이지의 게시글 추가
            postsToShow.forEach(post => {
                const newPost = document.createElement('div');
                newPost.className = 'qna-item';
                const secretIcon = post.isSecret ? '<i class="fas fa-lock" style="color: #666; margin-right: 5px;"></i>' : '';
                newPost.innerHTML = `
                    <div class="qna-info">
                        <a href="post-detail.html?id=${post.id}" class="qna-title">${secretIcon}${post.title}</a>
                        <span class="qna-meta">${post.number}</span>
                        <span class="qna-user">${post.author}</span>
                        <span class="qna-date">${post.date}</span>
                    </div>
                `;
                qnaList.appendChild(newPost);
            });
        }

        function showPostDetail(postId) {
            const post = allPosts.find(p => p.id === postId);
            if (!post) return;

            currentPostId = postId;
            const detail = document.getElementById('postDetail');
            document.getElementById('detailTitle').textContent = post.title;
            document.getElementById('detailMeta').textContent = `번호: ${post.number} | 작성자: ${post.author} | 작성일: ${post.date}`;
            document.getElementById('detailContent').textContent = post.content;
            
            detail.classList.add('active');
            document.getElementById('writeForm').classList.remove('active');
        }

        function editPost() {
            if (!currentPostId) return;
            
            const post = allPosts.find(p => p.id === currentPostId);
            if (!post) return;

            document.getElementById('title').value = post.title;
            document.getElementById('content').value = post.content;
            
            document.getElementById('postDetail').classList.remove('active');
            document.getElementById('writeForm').classList.add('active');
            
            // 수정 모드로 변경
            const submitBtn = document.querySelector('.btn-submit');
            submitBtn.textContent = '수정';
            submitBtn.onclick = updatePost;
        }

        function updatePost() {
            if (!currentPostId) return;
            
            const title = document.getElementById('title').value;
            const content = document.getElementById('content').value;
            
            if (!title || !content) {
                alert('제목과 내용을 모두 입력해주세요.');
                return;
            }

            const postIndex = allPosts.findIndex(p => p.id === currentPostId);
            if (postIndex === -1) return;

            allPosts[postIndex].title = title;
            allPosts[postIndex].content = content;

            showPosts();
            document.getElementById('writeForm').classList.remove('active');
            currentPostId = null;
            
            // 작성 모드로 복원
            const submitBtn = document.querySelector('.btn-submit');
            submitBtn.textContent = '등록';
            submitBtn.onclick = submitPost;
        }

        function deletePost() {
            if (!currentPostId) return;
            
            if (!confirm('정말 삭제하시겠습니까?')) return;

            allPosts = allPosts.filter(p => p.id !== currentPostId);
            
            document.getElementById('postDetail').classList.remove('active');
            currentPostId = null;
            
            showPosts();
        }

        // 게시글 데이터를 localStorage에 저장
        function savePosts() {
            localStorage.setItem('posts', JSON.stringify(allPosts));
        }

        // 초기 게시글 데이터
        const initialPosts = [
            { id: 1, title: 'q&amp;a test 2', content: '첫 번째 게시글 내용입니다.', number: 1000056, author: '홍길동', date: '2020-08-31' },
            { id: 2, title: 'q&amp;a test 2', content: '두 번째 게시글 내용입니다.', number: 1000055, author: '김철수', date: '2020-08-31' },
            { id: 3, title: 'q&amp;a test', content: '세 번째 게시글 내용입니다.', number: 1000054, author: '이영희', date: '2020-08-31' },
            { id: 4, title: 'q&amp;a test', content: '네 번째 게시글 내용입니다.', number: 1000053, author: '박지성', date: '2020-08-31' },
            { id: 5, title: 'q&amp;a test', content: '다섯 번째 게시글 내용입니다.', number: 1000052, author: '최민수', date: '2020-08-29' }
        ];

        // 초기 데이터 설정
        allPosts = [...initialPosts];
        savePosts();
        showPosts();
        updatePagination();

        function showCategory(category) {
            const noticeSection = document.getElementById('noticeSection');
            const qnaSection = document.getElementById('qnaSection');
            const noticeTab = document.querySelector('.tab-btn:nth-child(1)');
            const qnaTab = document.querySelector('.tab-btn:nth-child(2)');

            if (category === 'notice') {
                noticeSection.style.display = 'block';
                qnaSection.style.display = 'none';
                noticeTab.classList.add('active');
                qnaTab.classList.remove('active');
            } else {
                noticeSection.style.display = 'none';
                qnaSection.style.display = 'block';
                noticeTab.classList.remove('active');
                qnaTab.classList.add('active');
            }
        }
    </script>

    <?php include 'common/footer.php'; ?>
</body>
</html> 