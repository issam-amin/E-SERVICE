<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1ba11ba8a8.js" crossorigin="anonymous"></script>
    <title>Document</title>
 <style>
                :root {
            --primary-color: #353535;
                }
               .parent {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                grid-template-rows: 1fr;
                grid-column-gap: 25px;
                grid-row-gap: 0px;
            }
                .parent div{
                    padding: 20px;
                    border-radius: 52px;
                    /* box-shadow:  0px 2px 5px #888888,
                            -0px -5px 10px #acacac;  */
                    background: #313131;
                    text-align: center;

                }
                .div1 {
                    color: rgb(245, 245, 245);
                    /* border: solid 2px rgb(243, 243, 243); */
                    grid-area: 1 / 1 / 2 / 2; 
                
                }
                .div2 {
                    color: #ffffff;
                    /* border: solid 2px #ffffff; */
                    grid-area: 1 / 2 / 2 / 3; 
                }
                .div3 {
                    color: #ffffff;
                    /* border: solid 2px #ffffff; */
                    grid-area: 1 / 3 / 2 / 4; 
                    }
                .div4 { 
                    color: #fdfdfd;
                    /* border: solid 2px #ffffff; */
                    grid-area: 1 / 4 / 2 / 5;
                }
                p{
                    display: flex;
                    align-items: center; 
                    justify-content: center;
                    justify-content: space-around;
                }
                a{
                    color: inherit;
                    text-decoration: none;
                    font-size: 20px;
                    font-family: sans-serif;
                    font-weight: bold;

                }
                i{
                    font-size: 25px;
                }
                .card {

                width: 190px;
                height: auto;
                border-radius: 30px;
                background: #e0e0e0;
                box-shadow: 0px 0px 3px #bebebe,
                            -5px -5px 3px #e1e1e1;
                }
                .mainContainer{
                    margin-left: 5rem;
                    display: grid;
                    grid-template-columns: repeat(4, 1fr);
                    place-items: center;
                    gap: 2rem;
                }
                .parent{
                    grid-column: span 4;
                    width: 100%;
                }
                .card{
                    grid-column: 4;
                    padding: 1rem;
                }

    </style>
</head>
<body>
    <div class="mainContainer">
        <section class="parent">

            <div class="div1 maindiv"> 
                <p >
                    <a href="#">Emploi de temps</a>
                    <i class="fa-solid fa-calendar-days"></i>
                </p>
            </div>
            <div class="div2 maindiv">
                <p>
                    <a href="#">Demandes</a>
                    <i class="fa-regular fa-file-lines"></i>
                    
                </p>
             </div>
            <div class="div3 maindiv">
                <p>
                    <a href="#">Messagerie</a> 
                    <i class="fa-regular fa-envelope"></i>
                </p>
            </div>
            <div class="div4 maindiv">
                
                 <p>
                    <a href="#">Publication</a>
                    <i class="fa-solid fa-calendar"></i>
                </p>
            </div>
        </section>
        
    
        <div class="card">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quibusdam qui laboriosam facere suscipit excepturi voluptate saepe, quaerat sint dolore reprehenderit. Nesciunt dolores amet inventore reiciendis at itaque quibusdam architecto nobis.
        </div>
    
    </div>
    
</body>
</html>