<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:output indent="yes" />

    <xsl:template match="/">
        <root>
            <xsl:apply-templates select="/root/entry">
                <xsl:sort select="@id" data-type="number" order="ascending" />
                <xsl:with-param name="test" select="'demo'" />
            </xsl:apply-templates>
        </root>
    </xsl:template>

    <xsl:template match="entry">
        <xsl:param name="test" />
        <p title="{$test}"><xsl:value-of select="@id" /></p>
    </xsl:template>


</xsl:stylesheet>
