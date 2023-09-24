import React, { useEffect, useState } from 'react';
import { render } from 'react-dom';
import { decode } from 'html-entities';

const translate = text => text;

const orders = [
    {
        order: `oldest`,
        title: `Oldest to Newest`
    },
    {
        order: `newest`,
        title: `Newest to Oldest`
    },
    {
        order: `a-z`,
        title: `A–Z`
    },
    {
        order: `z-a`,
        title: `Z–A`
    }
];

const PostTableButton = props => {
    let className = `gomike-story-table-h-btn gomike-story-table-h-btn--${ props.type }`;
    return <button aria-label={ props.ariaLabel } className={ className } onClick={ props.onClick }>
        { props.children }
    </button>;
};

const PostTable = props => {
    const titleHeaderButtonType = props.order === `a-z` ? `down` : ( props.order === `z-a` ? `up` : `normal` );
    const dateHeaderButtonType = props.order === `oldest` ? `down` : ( props.order === `newest` ? `up` : `normal` );
    const titleAriaLabel = props.order === `a-z` ? `Order Reverse Alphabetical` : `Order Alphabetical`;
    const dateAriaLabel = props.order === `newest` ? `Order Oldest to Newest` : `Order Newest to Oldest`;

    const changeTitleOrder = () => {
        const order = props.order === `a-z` ? `z-a` : `a-z`;
        props.setOrder( order );
    };

    const changeDateOrder = () => {
        const order = props.order === `newest` ? `oldest` : `newest`;
        props.setOrder( order );
    };

    return <table className="gomike-story-table">
        <thead className="gomike-story-table-head">
            <tr className="gomike-story-table-row">
                <th className="gomike-story-table-col gomike-story-table-h-title">
                    <PostTableButton ariaLabel={ titleAriaLabel } type={ titleHeaderButtonType } onClick={ changeTitleOrder }>
                        { translate( `Title` ) }
                    </PostTableButton>
                </th>
                <th className="gomike-story-table-col gomike-story-table-h-date">
                    <PostTableButton ariaLabel={ dateAriaLabel } type={ dateHeaderButtonType } onClick={ changeDateOrder }>
                        { translate( `Date` ) }
                    </PostTableButton>
                </th>
            </tr>
        </thead>
        <tbody className="gomike-story-table-body">
            {
                props.posts.map( post => <tr className="gomike-story-table-row">
                    <td className="gomike-story-table-col">
                        <h2 className="gomike-story-table-title">
                            <a
                                href={ post.url }
                                className="gomike-story-table-link"
                                dangerouslySetInnerHTML={{ __html: post.title }}
                            />
                        </h2>
                    </td>
                    <td className="gomike-story-table-col">
                        <div className="gomike-story-table-date">{ post.date.display }</div>
                    </td>
                </tr>)
            }
        </tbody>
    </table>;
};

const PostList = props => {
    return <div>
        <ul className="gomike-story-list-order-l">
            { orders.map( order => <li className="gomike-story-list-order-i">
                <button
                    className="gomike-story-list-order-btn"
                    disabled={ order.order === props.order } onClick={ () => props.setOrder( order.order ) }
                >
                    { order.title }
                </button>
            </li>) }
        </ul>
        <ul className="gomike-story-list">
            { props.posts.map( post => <li className="gomike-story-list-item">
                <h2 className="gomike-story-list-title">
                    <a
                        href={ post.url }
                        className="gomike-story-list-link"
                        dangerouslySetInnerHTML={{ __html: post.title }}
                    />
                </h2>
                <div className="gomike-story-list-date">
                    { post.date.display }
                </div>
            </li> )}
        </ul>
    </div>;
};

const Archive = props => {
    const [ windowWidth, setWindowWidth ] = useState( window.innerWidth );
    const [ posts, setPosts ] = useState( props.initialPosts );
    const [ order, setOrderRaw ] = useState( `oldest` );

    const isMobile = windowWidth < 1000;

    const createSorter = ( prop, sign ) => ( posts ) => [ ...posts ].sort( ( a, b ) => {
        const propA = prop( a );
        const propB = prop( b );
        return propA === propB ? 0
            : ( propA < propB ) ? -1 * sign : 1 * sign;
    });

    const setOrder = order => {
        setOrderRaw( order );
        switch ( order ) {
            case ( `a-z` ): {
                setPosts( createSorter( o => o.title.replace( /[^A-Za-z0-9]/g ).toLowerCase(), 1 ) );
            } break;
            case ( `z-a` ): {
                setPosts( createSorter( o => o.title.replace( /[^A-Za-z0-9]/g ).toLowerCase(), -1 ) );
            } break;
            case ( `newest` ): {
                setPosts( createSorter( o => o.date.raw, -1 ) );
            } break;
            case ( `oldest` ): {
                setPosts( createSorter( o => o.date.raw, 1 ) );
            } break;
            default: {
                throw `¡Invalid order type for post archive!`;
            }
        }
    };

    useEffect( () => {
        const updateWindowWidth = () => setWindowWidth( window.innerWidth );

        window.addEventListener( `resize`, updateWindowWidth );

        return () => window.removeEventListener( `resize`, updateWindowWidth );
    }, [] );

    return <div>
        { isMobile && <PostList posts={ posts } order={ order } setOrder={ setOrder } /> }
        { !isMobile && <PostTable posts={ posts } order={ order } setOrder={ setOrder } /> }
    </div>;
};

document.addEventListener( 'DOMContentLoaded', () => {
    const archive = document.getElementById( 'gomike-story-archive' );
    const posts = Array.from( archive.querySelectorAll( '.gomike-story-list-item' ) ).map( item => {
        const link = item.querySelector( '.gomike-story-list-link' );
        const date = item.querySelector( '.gomike-story-list-date time' );
        return {
            title: link.innerHTML.trim(),
            url: link.getAttribute( `href` ),
            date: {
                raw: date.getAttribute( `datetime` ),
                display: date.innerHTML
            }
        };
    });
    render( <Archive initialPosts={ posts } />, archive );
});