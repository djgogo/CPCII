<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:func="http://exslt.org/functions"
                xmlns:pdxf="http://xml.phpdox.net/functions"
                extension-element-prefixes="func"
                exclude-result-prefixes="pdxf">


    <xsl:output indent="yes" />

    <xsl:template match="/">
        <root>
            <xsl:for-each select="//child">
                <xsl:call-template name="hugo" />
            </xsl:for-each>
        </root>
    </xsl:template>

    <xsl:template name="hugo">
        <p><xsl:copy-of select="pdxf:nl2br(text())" /></p>
    </xsl:template>

    <func:function name="pdxf:nl2br">
        <xsl:param name="string"/>
        <xsl:variable name="format">
            <xsl:value-of select="normalize-space(substring-before($string,'&#10;'))"/>
            <xsl:choose>
                <xsl:when test="contains($string,'&#10;')">
                    <br />
                    <xsl:copy-of select="pdxf:nl2br(substring-after($string,'&#10;'))" />
                </xsl:when>
                <xsl:otherwise>
                    <xsl:value-of select="$string"/>
                </xsl:otherwise>
            </xsl:choose>
        </xsl:variable>
        <func:result><xsl:copy-of select="$format" /></func:result>
    </func:function>

</xsl:stylesheet>
