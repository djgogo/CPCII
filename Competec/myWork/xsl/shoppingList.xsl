<xsl:stylesheet version="1.0" xmlns:h="urn:burger-ingredients" xmlns:bsl="urn:burger-shopping-list" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    exclude-result-prefixes="h bsl">

    <xsl:output
            method="html"
            doctype-public="XSLT-compat"
            omit-xml-declaration="yes"
            encoding="UTF-8"
            indent="yes" />

    <xsl:template match="/">
        <html>
            <body>

                <h1>Recipe</h1>
                <xsl:apply-templates select="/h:recipe/h:ingredients">
                </xsl:apply-templates>

                <xsl:apply-templates select="/h:recipe/bsl:shoppingList">
                </xsl:apply-templates>

            </body>
        </xsl:template>

        <xsl:template match="bsl:shoppingList">
            <h2>Shopping List</h2>

            <ul>
                <xsl:for-each select="//bsl:buy">
                    <li>
                        <span><xsl:value-of select="@amount" /></span>
                        <span><xsl:value-of select="." /></span>
                        <span><xsl:value-of select="@price" /></span>
                    </li>
                </xsl:for-each>
            </ul>

            <p>Total Price: <xsl:value-of select="@currency"/>&#160;<xsl:value-of select="@costs"/></p>
        </xsl:template>

        <xsl:template match="h:ingredients">
            <h2>Processing Instructions</h2>
            <ul>
                <xsl:for-each select="//h:ingredient">
                    <li><xsl:value-of select="@name" /></li>
                </xsl:for-each>
            </ul>

        </html>
    </xsl:template>

</xsl:stylesheet>