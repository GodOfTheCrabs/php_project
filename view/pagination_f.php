<head>
	<link rel="stylesheet" href="../style/pagination.css">
</head>
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        
        <li class="page-item <?= ($pagination->page == 1) ? 'disabled' : '' ?>">
            <a class="page-link" href="followed_events.php?page=<?= $pagination->prev ?>">Previous</a>
        </li>

        <?php foreach ($pagination->getVisiblePages() as $page): ?>
            <?php if ($page === '...'): ?>
                
                <li class="page-item disabled"><span class="page-link">...</span></li>
            <?php else: ?>
                
                <li class="page-item <?= ($page == $pagination->page) ? 'active' : '' ?>">
                    <a class="page-link" href="followed_events.php?page=<?= $page ?><?= isset($pagination->category) ? '&category=' . $pagination->category : '' ?><?= isset($pagination->title) ? '&search=' . $pagination->title : '' ?>"><?= $page ?></a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>

        
        <li class="page-item <?= ($pagination->page == $pagination->pages) ? 'disabled' : '' ?>">
            <a class="page-link" href="followed_events.php?page=<?= $pagination->next ?>">Next</a>
        </li>
    </ul>
</nav>