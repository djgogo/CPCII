<?xml version="1.0" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:output indent="yes" />

    <xsl:template match="/">
        <root>
            <xsl:for-each select="/root/entry">
                <p>
                    <xsl:if test="child">
                        <xsl:attribute name="title"><xsl:value-of select="child" /></xsl:attribute>
                    </xsl:if>
                    <xsl:value-of select="@id" />
                </p>
            </xsl:for-each>
        </root>
    </xsl:template>

</xsl:stylesheet>
