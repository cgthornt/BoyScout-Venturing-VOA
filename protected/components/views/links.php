
                        
                <div id="left-links">

                    <ul>
                        <?php foreach($this->getLinks() as $link)
                            echo '<li>', CHtml::link($link['title'], 'home/' . $link['title_url']),  '</li>';
                        ?>
                    </ul>
                    

                </div>
