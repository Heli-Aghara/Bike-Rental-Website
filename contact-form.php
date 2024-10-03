<?php 
    $page_title = 'Riding Tales - Contact Us';
    include 'includes/header.inc.php';
    include 'config.php';
?>
<?php 

    if(isset($_SESSION['message'])){
      echo "<script>alert('".htmlspecialchars($_SESSION['message'])."');</script>";
      unset($_SESSION['message']);
    }

?>
<div class="container mt-5">
    <h2 class="text-center mb-4">Contact/Feedback Form</h2>
    <form action="process_feedback.php" method="POST" action="process_feedback.php">
        <!-- Name -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" value="<?php if(isset($_SESSION['username'])) echo $_SESSION['username'];?>" class="form-control" id="name" name="username" readonly >
        </div>
        <div class="mb-3">
            <label for="subject" class="form-label">Subject:</label>
            <input type="text" class="form-control" id="subject" name="subject" placeholder="e.g. Regarding returning a bike..." required >
        </div>
        <!-- Feedback -->
        <div class="mb-3">
            <label for="feedback" class="form-label">Your Feedback/Query</label>
            <textarea class="form-control" id="feedback" name="feedback" rows="4" placeholder="Share your thoughts" required></textarea>
        </div>
        <!-- Rating -->
        <div class="mb-3">
            <label class="form-label">Rate Us</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="rating" id="rating1" value="1" required>
                <label class="form-check-label" for="rating1">1</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="rating" id="rating2" value="2" required>
                <label class="form-check-label" for="rating2">2</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="rating" id="rating3" value="3" required>
                <label class="form-check-label" for="rating3">3</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="rating" id="rating4" value="4" required>
                <label class="form-check-label" for="rating4">4</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="rating" id="rating5" value="5" required>
                <label class="form-check-label" for="rating5">5</label>
            </div>
        </div>

        <div class="form-text mt-3 mb-3">Note : Login is required to Submit feedback.</div>
        <!-- Submit Button -->
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Submit Feedback</button>
        </div>
    </form>
</div>

<?php include 'includes/footer.inc.php';?>