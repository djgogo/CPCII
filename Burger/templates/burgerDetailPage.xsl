<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:burger="http://burger.com/burger">

    <xsl:output encoding="UTF-8" indent="yes" method="xml"/>

    <xsl:template match="burger:burger">
        <html>
            <body>
                <h1>Burger Detail Seite</h1>

                <p>
                    Name:
                    <xsl:value-of select="burger:name" />
                </p>
                <p>
                    Preis:
                    <xsl:value-of select="burger:price" />
                </p>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>