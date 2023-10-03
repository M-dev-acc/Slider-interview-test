<?php
require_once './config/Database.php';
require_once './actions/category/sliders.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAYUR THORAT Interview test</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" /> <!-- jQuery Modal CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> <!-- jQuery Select2 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> <!-- Bootstrap CSS CDN -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script> <!-- jQuery js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script> <!-- jQuery Modal js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> <!-- jQuery Select2 js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> <!-- Bootstrap JS CDN -->

    <style>
        /* Add your custom styles here */
.nav-pills button.nav-link {
    border: 1px solid #ccc;
    margin-bottom: 10px;
    padding: 10px 15px;
    border-radius: 5px;
    text-align: left;
}

.nav-pills button.nav-link.active {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
}

.carousel {
    margin-top: 20px;
}

.carousel-inner {
    border: 1px solid #ccc;
    border-radius: 5px;
    overflow: hidden;
}

.carousel-item img {
    width: 100%;
    height: 300px;
    object-fit: cover;
}

.carousel-caption {
    background-color: rgba(0, 0, 0, 0.7);
    color: #fff;
    padding: 10px;
}

    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Mayur Thorat Technical Interview task</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pricing</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>  
    </header>
    <main class="container">
        <section id="addSliderFormSection" class="mb-5">
            <fieldset>
                <legend>Add slider</legend>
                <form method="post" id="addSliderForm" enctype="multipart/form-data">
                    <label for="sliderFileInput">Add slider image</label>
                    <select name="slider_category" id="categoryDropdown" class="w-100"></select>
                    <br/>

                    <label for="sliderFileInput">Add slider image</label>
                    <input type="file" name="slider_image" id="sliderFileInput">
                    <br/>
                    <label for="sliderFileInput">Slider title</label>
                    <input type="text" name="slider_title" id="sliderFileInput">
                    <br/>
                    <label for="sliderFileInput">Slider text</label>
                    <input type="text" name="slider_text" id="sliderFileInput">
                    <br/>

                    <input type="submit" value="Add slider" class="btn btn-primary">
                </form>
            </fieldset>
        </section>
        <section id="sliderSection">
            <div class="d-none d-md-flex align-items-start">
                
                <nav class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <?php
                    foreach (array_keys($categorySlidersCollection) as $key => $category) :
                    ?>
                    <button 
                        class= "<?=($key === 0) ? "nav-link active" : "nav-link" ?> "
                        id="v-pills-<?=$category?>-tab" 
                        data-bs-toggle="pill" 
                        data-bs-target="#v-pills-<?=$category?>" 
                        type="button" 
                        role="tab" 
                        aria-controls="v-pills-<?=$category?>" 
                        aria-selected="true">
                            <?=$category?>
                    </button>
                    <?php endforeach; ?>

                </nav>
                <main class="tab-content" id="v-pills-tabContent">
                    <?php foreach ($categorySlidersCollection as $category => $sliders) : ?>
                    
                    <div 
                    class="tab-pane fade <?=($category !== 'Learning') ?: 'show active' ?> " 
                    id="v-pills-<?=$category?>" 
                    role="tabpanel" 
                    aria-labelledby="v-pills-<?=$category?>-tab" 
                    tabindex="0">
                        <div id="carouselExampleIndicators<?=$category?>" class="carousel slide">
                            <div class="carousel-indicators">
                                <?php foreach ($sliders as $key => $slider) : ?>

                                <button 
                                type="button" 
                                data-bs-target="#carouselExampleIndicators<?=$category?>" 
                                data-bs-slide-to="<?=($key + 1)?>" class="<?=($key === 0) ? 'active' : '' ?>" 
                                aria-current="true" 
                                aria-label="<?=$slider['title']?>"></button>

                                <?php endforeach; ?>
                            </div>
                            <div class="carousel-inner">
                                <?php foreach ($sliders as $key => $slider) : ?>

                                <div class="carousel-item <?=($key === 0) ? 'active' : '' ?>">
                                    <img src="<?=$slider['image']?>" class="d-block w-100" alt="<?=$slider['title']?>">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5><?=$slider['title']?></h5>
                                        <p><?=$slider['text']?></p>
                                    </div>
                                </div>

                                <?php endforeach; ?>
                               
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators<?=$category?>" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators<?=$category?>" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>                            
                    </div>

                    <?php endforeach; ?>
                </main>
            </div>

            <div class="d-md-none accordion" id="accordionExample">
                <?php foreach ($categorySlidersCollection as $category => $sliders) : ?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?=$category?>" aria-expanded="true" aria-controls="collapseOne<?=$category?>">
                    <?=$category?>
                    </button>
                    </h2>
                    <div id="collapseOne<?=$category?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div 
                            class="tab-pane fade <?=($category !== 'Learning') ?: 'show active' ?> " 
                            id="v-pills-<?=$category?>" 
                            role="tabpanel" 
                            aria-labelledby="v-pills-<?=$category?>-tab" 
                            tabindex="0">
                                <div id="carouselExampleIndicators<?=$category?>" class="carousel slide">
                                    <div class="carousel-indicators">
                                        <?php foreach ($sliders as $key => $slider) : ?>

                                        <button 
                                        type="button" 
                                        data-bs-target="#carouselExampleIndicators<?=$category?>" 
                                        data-bs-slide-to="<?=($key + 1)?>" class="<?=($key === 0) ? 'active' : '' ?>" 
                                        aria-current="true" 
                                        aria-label="<?=$slider['title']?>"></button>

                                        <?php endforeach; ?>
                                    </div>
                                    <div class="carousel-inner">
                                        <?php foreach ($sliders as $key => $slider) : ?>

                                        <div class="carousel-item <?=($key === 0) ? 'active' : '' ?>">
                                            <img src="<?=$slider['image']?>" class="d-block w-100" alt="<?=$slider['title']?>">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5><?=$slider['title']?></h5>
                                                <p><?=$slider['text']?></p>
                                            </div>
                                        </div>

                                        <?php endforeach; ?>
                                    
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators<?=$category?>" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators<?=$category?>" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>                            
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
    <footer></footer>
    
    <script>

        $(document).ready(
            function () {
                const baseUrl = window.location.href;
                // Select2 Dropdown Implementation
                // Set Parent Dropdown data
                $('#categoryDropdown').select2({
                    placeholder: "Select a parent",
                    ajax: {
                        url: `${baseUrl}/actions/category/list.php`,
                        dataType: 'json'
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    }
                });

                // Create slider on form submit
                $('#addSliderForm').on('submit', function (event) {
                    event.preventDefault();
                    console.log("clicked submitted");
                    const submittedForm = event.target;
                    
                    // Submitting form using ajax
                    const formInupts = new FormData(submittedForm);
                    $.ajax({
                        url: `${baseUrl}/actions/slider/create.php`,
                        data: formInupts,
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            submittedForm.reset();
                            alert(response);
                        },
                        error: function (error) {
                            console.error(error);
                        },
                    });
                    
                });

            }
        );
    </script>
</body>
</html>