<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">

    <xsl:template match="/">        
        <html>
            <head>
                <title>About Us</title>
                <link rel="stylesheet" href="homestyle.css"/>
            </head>            
            <body>
            <h2 class="featured-title">About Us</h2>
            <div class="row">
                <div class="col-2">                
                <xsl:for-each select="About/info">
                    <h2><xsl:value-of select="title"/></h2>
                    <p><xsl:value-of select="answer"/></p>
                    <br></br>
                </xsl:for-each>                    
                </div>   
            </div>
            </body>
        </html>
    </xsl:template>
    

</xsl:stylesheet>
